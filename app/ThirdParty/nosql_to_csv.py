import sys
import re

'''
help: python nosql_to_csv.py [nosql-file] [project-folder]

E.g.:
    python nosql_to_csv.py /home/user/result.nosql /home/user/

'''
nosql_file = sys.argv[1]
PROJECT_DIR = sys.argv[2]

result_data = []

for line in open(nosql_file).readlines():

    line = line.split("\t")

    complex_name = line[0]

    # INFO ALINGMENT (SCORES, RMSD, ETC)
    align_info = [d for d in re.split(r'[()]', line[2])
                    if d.strip()][0].split(",")

    aligned_vertices = align_info[1]
    rmsd = align_info[3]
    sva = align_info[6]
    e_value = align_info[7]
    alignment_score = align_info[8]


    if float(alignment_score) > 0:

        # INTERFACE RESIDUES
        '''
        _, pdb, p_chain, r_chain = complex_data

        subjetc_pdb = INTERFACE_PDB_DIR + complex_name + ".pdb"
        s = PDBParser(QUIET=1).get_structure(pdb, subjetc_pdb)
        subject_residues_list = [str(r.get_id()[1])
                                    for r in s[0][r_chain].get_residues()]
        '''
        # RESIDUES ALIGMENT (FROM PROBIS)
        res_alignments = re.split(r'[()]', line[3])
        aligned_res_info = [d.split(",") for d in res_alignments
                            if d.strip() and d.strip() != ","]

        query_aligned_res = [r[3] for r in aligned_res_info
                                if int(r[7]) == 0]

        subject_aligned_res = [r[6] for r in aligned_res_info
                                if int(r[7]) == 0]

        result_data.append((complex_name, alignment_score, rmsd,
                            ",".join(query_aligned_res),
                            ",".join(subject_aligned_res)))

# SORT BY ALIGNMEN SCORE
result_data = sorted(result_data, key=lambda x: float(x[1]),
                        reverse=True)

result_csv = open(PROJECT_DIR + "result.csv", "w")
headers = "COMPLEX NAME;ALIGNMENT SCORE;RMSD;"\
            "QUERY ALIGNED RESIDUES;"\
            "SUBJECT ALIGNED RESIDUES\n"
result_csv.write(headers)
for r in result_data:
    result_csv.write(";".join(r) + "\n")
result_csv.close()
